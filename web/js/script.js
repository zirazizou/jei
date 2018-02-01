
$(document).ready(function(){
    //<div class="form-group">
    // <label class="control-label required">__name__label__</label>
        // <div id="oc_platformbundle_advert_categories___name__">
            // <div class="form-group">
                // <label class="control-label required" for="oc_platformbundle_advert_categories___name___name">Name</label>
                // <input type="text" id="oc_platformbundle_advert_categories___name___name" name="oc_platformbundle_advert[categories][__name__][name]" required="required" class="form-control" />
            // </div>
        // </div>
    // </div>
    var $container = $("div#oc_platformbundle_advert_categories");
    var index = $container.find(':input').length;

    $('#add_category').click(function(e){
        addCategory($container);
        e.preventDefault();
        return false;
    })

    if(index === 0){
        addCategory($container);
    }else{
        $container.children('div').each(function(){
            addDeleteLink($(this));
        });
    }

    function addCategory($container){
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Category n '+(index + 1))
            .replace(/__name__/g, index);
        console.log(template);
        var $prototype = $(template);
        addDeleteLink($prototype);
        $container.append($prototype);

        index++;
    }

    function addDeleteLink($prototype){
        var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');

        $prototype.append($deleteLink);
        $deleteLink.click(function(e){
            $prototype.remove();
            e.preventDefault();
            return false;
        });
    }
});