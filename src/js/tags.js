(function() {
    let tagList = [];
    const tagDiv = document.querySelector('#tags');
    const tagInputHidden = document.querySelector('[name="tags"]');
    const tagInput = document.querySelector('#tags-input');

    document.addEventListener('DOMContentLoaded', function() {
        start();
    })
    
    function start() {
        addTagsListener();
    }
    
    function addTagsListener() {
        tagInput.addEventListener('keyup', function(e) {
            if(e.key === ',') {
                const tag = e.target.value.replace(',', '').trim();
                if(tag.length > 2) {
                    tagList = [...tagList, tag]
                    showTags();
                    updateInputHidden();
                }
                e.target.value = '';
            }
        })
    }

    function showTags() {
        tagDiv.innerHTML = '';
        tagList.forEach(tag => {
            const tagItem = document.createElement('LI');
            tagItem.classList.add('tag-item');
            tagItem.textContent = tag;
            tagItem.ondblclick = deleteTag;
            tagDiv.appendChild(tagItem);
        })

    }

    function updateInputHidden() {
        tagInputHidden.value = tagList.toString();
    }

    function deleteTag(e) {
        e.target.remove();
        tagList = tagList.filter(tag => tag != e.target.textContent);
        updateInputHidden();
    }
})();
