$(document).ready(function() {
    let editingNoteId = null;
    
    // Initialize the app
    loadTypes();
    loadNotes();
    
    // Form submission handler
    $('#note-form').on('submit', function(e) {
        e.preventDefault();
        
        const formData = {
            devtype_id: $('#devtype_id').val(),
            title: $('#title').val().trim(),
            content: $('#content').val().trim(),
            priority: parseInt($('#priority').val())
        };
        
        if (!formData.title) {
            alert('Please enter a title');
            return;
        }
        
        if (!formData.devtype_id) {
            alert('Please select a type');
            return;
        }
        
        if (editingNoteId) {
            updateNote(editingNoteId, formData);
        } else {
            createNote(formData);
        }
    });
    
    // Cancel edit handler
    $('#cancel-edit').on('click', function() {
        resetForm();
    });
    
    // Load note types
    function loadTypes() {
        $.ajax({
            url: '/devjquery/api/types',
            type: 'GET',
            dataType: 'json',
            success: function(types) {
                const select = $('#devtype_id');
                select.empty();
                
                types.forEach(function(type) {
                    select.append(`<option value="${type.id}">${type.name}</option>`);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error loading types:', error);
                $('#devtype_id').html('<option value="">Error loading types</option>');
            }
        });
    }
    
    // Load notes
    function loadNotes() {
        $('#loading').show();
        
        $.ajax({
            url: '/devjquery/api/list',
            type: 'GET',
            dataType: 'json',
            success: function(notes) {
                renderNotes(notes);
                $('#loading').hide();
            },
            error: function(xhr, status, error) {
                console.error('Error loading notes:', error);
                $('#notes-container').html('<div class="p-6 text-red-600">Error loading notes</div>');
                $('#loading').hide();
            }
        });
    }
    
    // Create new note
    function createNote(formData) {
        $.ajax({
            url: '/devjquery/api/store',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    loadNotes();
                    resetForm();
                } else {
                    alert('Error creating note: ' + (response.error || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error('Error creating note:', error);
                alert('Network error occurred');
            }
        });
    }
    
    // Update existing note
    function updateNote(noteId, formData) {
        formData.id = noteId;
        
        $.ajax({
            url: '/devjquery/api/update',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    loadNotes();
                    resetForm();
                } else {
                    alert('Error updating note: ' + (response.error || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error('Error updating note:', error);
                alert('Network error occurred');
            }
        });
    }
    
    // Delete note
    function deleteNote(noteId) {
        if (!confirm('Are you sure you want to delete this note?')) {
            return;
        }
        
        $.ajax({
            url: '/devjquery/api/delete',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: noteId }),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'ok') {
                    loadNotes();
                    if (editingNoteId == noteId) {
                        resetForm();
                    }
                } else {
                    alert('Error deleting note: ' + (response.error || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error('Error deleting note:', error);
                alert('Network error occurred');
            }
        });
    }
    
    // Reset form to add mode
    function resetForm() {
        editingNoteId = null;
        $('#title').val('');
        $('#content').val('');
        $('#priority').val('2');
        $('#devtype_id').prop('selectedIndex', 0);
        $('#cancel-edit').hide();
        $('.bg-blue-600').text('Add Note');
    }
    
    // Get priority display info
    function getPriorityInfo(priority) {
        switch (parseInt(priority)) {
            case 1:
                return { text: 'High', class: 'text-red-600 bg-red-100' };
            case 2:
                return { text: 'Medium', class: 'text-yellow-600 bg-yellow-100' };
            case 3:
                return { text: 'Low', class: 'text-green-600 bg-green-100' };
            default:
                return { text: 'Unknown', class: 'text-gray-600 bg-gray-100' };
        }
    }
    
    // Render notes list
    function renderNotes(notes) {
        const container = $('#notes-container');
        
        if (notes.length === 0) {
            container.html('<div class="p-6 text-gray-500 text-center">No notes yet. Add your first note above!</div>');
            return;
        }
        
        const html = notes.map(function(note) {
            const priority = getPriorityInfo(note.priority);
            const createdDate = new Date(note.created_at).toLocaleString();
            
            return `
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg font-medium text-gray-900">${escapeHtml(note.title)}</h3>
                                <span class="inline-block w-3 h-3 rounded-full" style="background-color: ${note.color}" title="${escapeHtml(note.type_name)}"></span>
                                <span class="text-sm text-gray-500">${escapeHtml(note.type_name)}</span>
                                <span class="px-2 py-1 text-xs font-medium rounded-full ${priority.class}">
                                    ${priority.text}
                                </span>
                            </div>
                            ${note.content ? `<p class="text-gray-600 mb-2">${escapeHtml(note.content)}</p>` : ''}
                            <p class="text-sm text-gray-500">Created: ${createdDate}</p>
                        </div>
                        <div class="flex gap-2 ml-4">
                            <button class="edit-note text-blue-600 hover:text-blue-800 text-sm font-medium" data-id="${note.id}">
                                Edit
                            </button>
                            <button class="delete-note text-red-600 hover:text-red-800 text-sm font-medium" data-id="${note.id}">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
        
        container.html(html);
        
        // Attach event handlers for edit/delete buttons
        container.find('.edit-note').on('click', function() {
            const noteId = $(this).data('id');
            const note = notes.find(n => n.id == noteId);
            if (note) {
                editNote(note);
            }
        });
        
        container.find('.delete-note').on('click', function() {
            const noteId = $(this).data('id');
            deleteNote(noteId);
        });
    }
    
    // Edit note - populate form
    function editNote(note) {
        editingNoteId = note.id;
        $('#devtype_id').val(note.devtype_id);
        $('#title').val(note.title);
        $('#content').val(note.content);
        $('#priority').val(note.priority);
        $('#cancel-edit').show();
        $('.bg-blue-600').text('Update Note');
        
        // Scroll to form
        $('html, body').animate({
            scrollTop: $('#note-form').offset().top - 100
        }, 500);
    }
    
    // Utility function to escape HTML
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
});