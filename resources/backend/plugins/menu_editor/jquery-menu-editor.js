
/**
 * @version 1.1.0
 * @author David Ticona Saravia
 * @param {string} idSelector Attr ID
 * @param {object} options Options editor
 * */
function MenuEditor(idSelector, options) {
    var $main = $("#" + idSelector).data("level", "0");
    var settings = {
        labelEdit: '<i class="fas fa-edit clickable"></i>',
        labelRemove: '<i class="fas fa-trash-alt clickable"></i>',
        textConfirmDelete: 'This item will be deleted. Are you sure?',
        maxLevel: -1,
        listOptions: {
            hintCss: { border: '1px dashed #13981D'},
            opener: {
                as: 'html',
                close: '<i class="fas fa-minus"></i>',
                open: '<i class="fas fa-plus"></i>',
                openerCss: {'margin-right': '10px', 'float': 'none'},
                openerClass: 'btn btn-success btn-sm',
            },
            placeholderCss: {'background-color': 'gray'},
            ignoreClass: 'clickable',
            listsClass: "pl-0",
            listsCss: {"padding-top": "10px"},
            complete: function (cEl) {
                MenuEditor.updateButtons($main);
                $main.updateLevels(0);
                return true;
            },
            isAllowed: function(currEl, hint, target) {
                return isValidLevel(currEl, target);
            }
        }
    };
    $.extend(true, settings, options);
    var itemEditing = null;
    var sortableReady = true;
    var $form = null;
    var $updateButton = null;
    var options = settings.listOptions;
    $main.sortableLists(settings.listOptions);

    /* EVENTS */


    $(document).on('click', '.btnRemove', function (e) {
        e.preventDefault();
        if (confirm(settings.textConfirmDelete)) {
            var list = $(this).closest('ul');
            $(this).closest('li').remove();
            var isMainContainer = false;
            if (typeof list.attr('id') !== 'undefined') {
                isMainContainer = (list.attr('id').toString() === idSelector);
            }
            if ((!list.children().length) && (!isMainContainer)) {
                list.prev('div').children('.sortableListsOpener').first().remove();
                list.remove();
            }
            MenuEditor.updateButtons($main);
        }
    });

    $(document).on('click', '.btnEdit', function (e) {
        e.preventDefault();
        itemEditing = $(this).closest('li');
        editItem(itemEditing);
    });

    $main.on('click', '.btnUp', function (e) {
        e.preventDefault();
        var $li = $(this).closest('li');
        $li.prev('li').before($li);
        MenuEditor.updateButtons($main);
    });
    $main.on('click', '.btnDown', function (e) {
        e.preventDefault();
        var $li = $(this).closest('li');
        $li.next('li').after($li);
        MenuEditor.updateButtons($main);
    });
    $main.on('click', '.btnOut', function (e) {
        e.preventDefault();
        var list = $(this).closest('ul');
        var $li = $(this).closest('li');
        var $liParent = $li.closest('ul').closest('li');
        $liParent.after($li);
        if (list.children().length <= 0) {
            list.prev('div').children('.sortableListsOpener').first().remove();
            list.remove();
        }
        MenuEditor.updateButtons($main);
        $main.updateLevels();
    });
    $main.on('click', '.btnIn', function (e) {
        e.preventDefault();
        var $li = $(this).closest('li');
        var $prev = $li.prev('li');
        if (! isValidLevel($li, $prev)) {
            return false;
        }
        if ($prev.length > 0) {
            var $ul = $prev.children('ul');
            if ($ul.length > 0)
                $ul.append($li);
            else {
                var $ul = $('<ul>').addClass('pl-0').css('padding-top', '10px');
                $prev.append($ul);
                $ul.append($li);
                $prev.addClass('sortableListsOpen');
                TOpener($prev);
            }
        }
        MenuEditor.updateButtons($main);
        $main.updateLevels();
    });

    /* PRIVATE METHODS */
    function editItem($item) {
        var data = $item.data();
        $.each(data, function (p, v) {
            $form.find("[name=" + p + "]").val(v);
        });
        $form.find(".item-menu").first().focus();
        $updateButton.removeAttr('disabled');
    }

    function resetForm() {
        $form[0].reset();
        $updateButton.attr('disabled', true);
        itemEditing = null;
    }

    function stringToArray(str) {
        try {
            var obj = JSON.parse(str);
        } catch (err) {
            console.log('The string is not a json valid.');
            return null;
        }
        return obj;
    }

    function TButton(attr) {
        return $("<a>").addClass(attr.classCss).addClass('clickable').attr("href", "#").html(attr.text);
    }

    function TButtonGroup() {
        var $divbtn = $('<div>').addClass('btn-group float-right');
        var $btnEdit = TButton({classCss: 'btn btn-primary btn-sm btnEdit', text: settings.labelEdit});
        var $btnRemv = TButton({classCss: 'btn btn-danger btn-sm btnRemove', text: settings.labelRemove});
        var $btnUp = TButton({classCss: 'btn btn-secondary btn-sm btnUp btnMove', text: '<i class="fas fa-angle-up clickable"></i>'});
        var $btnDown = TButton({classCss: 'btn btn-secondary btn-sm btnDown btnMove', text: '<i class="fas fa-angle-down clickable"></i>'});
        var $btnOut = TButton({classCss: 'btn btn-secondary btn-sm btnOut btnMove', text: '<i class="fas fa-level-down-alt clickable"></i>'});
        var $btnIn = TButton({classCss: 'btn btn-secondary btn-sm btnIn btnMove', text: '<i class="fas fa-level-up-alt clickable"></i>'});
        $divbtn.append($btnUp).append($btnDown).append($btnIn).append($btnOut).append($btnEdit).append($btnRemv);
        return $divbtn;
    }

    /**
     * @param {array} arrayItem Object Array
     * @param {int} depth Depth sub-menu
     * @return {object} jQuery Object
     **/
    function createMenu(arrayItem, depth) {
        var level = (typeof (depth) === 'undefined') ? 0 : depth;
        var $elem = (level === 0) ? $main : $('<ul>').addClass('pl-0').css('padding-top', '10px').data("level", level);
        $.each(arrayItem, function (k, v) {
            var isParent = (typeof (v.children) !== "undefined") && ($.isArray(v.children));
            var itemObject = {text: "", href: "", icon: "empty", target: "_self", title: ""};
            var temp = $.extend({}, v);
            if (isParent){
                delete temp['children'];
            }
            $.extend(itemObject, temp);
            var $li = $('<li>').addClass('list-group-item pr-0');
            $li.data(itemObject);
            var $div = $('<div>').css('overflow', 'auto');
            var $i = $('<i>').addClass(v.icon);
            var $span = $('<span>').addClass('txt').append(v.text).css('margin-right', '5px');
            var $divbtn =  TButtonGroup();
            $div.append($i).append("&nbsp;").append($span).append($divbtn);
            $li.append($div);
            if (isParent) {
                $li.append(createMenu(v.children, level + 1));
            }
            $elem.append($li);
        });
        return $elem;
    }

    function TOpener(li){
        var opener = $('<span>').addClass('sortableListsOpener ' + options.opener.openerClass).css(options.opener.openerCss)
                .on('mousedown touchstart', function (e){
                    var li = $(this).closest('li');
                    if (li.hasClass('sortableListsClosed')) {
                        li.iconOpen(options);
                    } else {
                        li.iconClose(options);
                    }
                    return false; // Prevent default
                });
        opener.prependTo(li.children('div').first());
        if ( !li.hasClass('sortableListsOpen') ) {
            li.iconClose(options);
        } else {
            li.iconOpen(options);
        }
    }

    function setOpeners() {
        $main.find('li').each(function () {
            var $li = $(this);
            if ($li.children('ul').length) {
                TOpener($li);
            }
        });
    }

    function isValidLevel($li, $liTarget) {
        if (settings.maxLevel < 0){
            return true;
        }
        var targetLevel = 0;
        var liCount = $li.find('ul').length;
        if ($liTarget.length==0) {
            targetLevel = 0;
        } else {
            targetLevel = parseInt($liTarget.parent().data("level")) + 1;
        }
        console.log((targetLevel + liCount));
        return ((targetLevel + liCount)<=settings.maxLevel)
    }

    /* PUBLIC METHODS */
    this.setForm = function(form){
        $form = form;
    };

    this.getForm = function(){
        return $form;
    };

    this.setUpdateButton = function($btn) {
        $updateButton = $btn;
        $updateButton.attr('disabled', true);
        itemEditing = null;
    };

    this.getUpdateButton = function(){
        return $updateButton;
    };

    this.getCurrentItem = function(){
        return itemEditing;
    };

    this.update = function(){
        var $cEl = this.getCurrentItem();
        if ($cEl===null){
            return;
        }
        var oldIcon = $cEl.data('icon');
        $form.find('.item-menu').each(function() {
            $cEl.data($(this).attr('name'), $(this).val());
        });
        $cEl.children().children('i').removeClass(oldIcon).addClass($cEl.data('icon'));
        $cEl.find('span.txt').first().text($cEl.data('text'));
        resetForm();
    };

    this.add = function(){
        var data = {};
        $form.find('.item-menu').each(function() {
            data[$(this).attr('name')] = $(this).val();
        });
        var btnGroup = TButtonGroup();
        var textItem = $('<span>').addClass('txt').text(data.text);
        var iconItem = $('<i>').addClass(data.icon);
        var div = $('<div>').css({"overflow": "auto"}).append(iconItem).append("&nbsp;").append(textItem).append(btnGroup);
        var $li = $("<li>").data(data);
        $li.addClass('list-group-item pr-0').append(div);
        $main.append($li);
        MenuEditor.updateButtons($main);
        resetForm();
    };
    /**
     * Data Output
     * @return String JSON menu scheme
     */
    this.getString = function () {
        var obj = $main.sortableListsToJson();
        return JSON.stringify(obj);
    };
    /**
     * Data Input
     * @param {Array} Object array. The nested menu scheme
     */
    this.setData = function (strJson) {
        var arrayItem = (Array.isArray(strJson)) ? strJson : stringToArray(strJson);
        if (arrayItem !== null) {
            $main.empty();
            var menu = createMenu(arrayItem);
            if (!sortableReady) {
                menu.sortableLists(settings.listOptions);
                sortableReady = true;
            } else {
                setOpeners();
            }
            MenuEditor.updateButtons($main);
        }
    };
};
/* STATIC METHOD */
/**
 * Update the buttons on the list. Only the buttons 'Up', 'Down', 'In', 'Out'
 * @param {jQuery} $mainList The unorder list
 **/
MenuEditor.updateButtons = function($mainList) {
    $mainList.find('.btnMove').show();
    $mainList.updateButtons();
};
