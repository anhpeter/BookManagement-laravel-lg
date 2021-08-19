let domSlt = {
    deleteItemForm: '.delete-item-form',
    deleteItemModal: '#delete-item-modal',
    get deleteItemName() { return `${this.deleteItemModal} .item-name` },
    get deleteItemModalSaveBtn() { return `${this.deleteItemModal} .save-btn` },

    imageFileInput: $('input#image-file-input'),
    editImageBtn: $('form .edit-image-btn'),
    formImage: $('form .form-image'),
    imageModal: $('#image-modal'),
    imageTextInput: $('#image-text-input'),
    btnCropped: $('.btn-cropped'),
    image: $('#crop-image'),

    // meta
    controllerMeta: $('meta[name="controller"]'),

    // search
    searchForm: $('.search-form'),
    searchInput: $('.search-form input'),
    searchBar: $('.search-bar'),
    searchTypeBtn: $('.search-bar .btn-search-type'),
    searchBarOption: $('.search-bar .dropdown-item'),

    // index
    filterSelect: $('.filter-select'),
    updateSelect: $('.update-select'),
}

$(document).ready(function () {
    setupEvents();

});

function setupEvents() {
    $("body").tooltip({
        selector: '[data-toggle=tooltip]'
    });
    $('.toast').toast('show');
    deleteItemHandler();
    setEditImageHandler();
    setImageInputFileChange();
    setSearchBar();
    setFilterSelect();
}

function setFilterSelect() {
    domSlt.filterSelect.change(function (e) {
        let key = $(this).attr('name') + "_filter";
        let urlParams = new URLSearchParams(location.search);
        urlParams.set(key, $(this).val());
        let link = `/admin/${getPluralController()}?${urlParams.toString()}`;
        location.href = link;
    });
}

function setSearchBar() {
    domSlt.searchForm.submit(function (e) {
        e.preventDefault();
        let urlParams = new URLSearchParams(location.search);
        let key = domSlt.searchTypeBtn.data('name');
        let value = domSlt.searchInput.val();
        urlParams.set('search_field', key);
        urlParams.set('search_value', value);
        location.href = `/admin/${getPluralController()}?${urlParams.toString()}`;
    });

    domSlt.searchBarOption.click(function (e) {
        let key = $(this).data('name');
        let value = $(this).text();
        domSlt.searchTypeBtn.data('name', key);
        domSlt.searchTypeBtn.text(value);
    });
}



function setEditImageHandler() {
    domSlt.editImageBtn.click(function () {
        domSlt.imageFileInput.trigger('click');
    });
    domSlt.btnCropped.click(function () {
        let data = domSlt.image.cropper('getCroppedCanvas').toDataURL("image/png")
        domSlt.imageTextInput.val(data);
        domSlt.formImage.attr('src', data);
        domSlt.imageModal.modal('hide');
    });
}

function setImageInputFileChange() {
    domSlt.imageFileInput.change(function () {
        domSlt.imageModal.modal();
        setTimeout(() => {
            var [file] = domSlt.imageFileInput.prop('files');
            domSlt.image.attr('src', URL.createObjectURL(file));
            try { } catch (e) { }
            domSlt.image.cropper('destroy');
            setCropperImage();
        }, 200)
        // you have to declare the file loading
    });
}

let deleteItemForm = null;
function deleteItemHandler() {
    $(domSlt.deleteItemForm).submit(function (e) {
        let canSubmit = $(this).data('can-submit') == 'true';
        console.log(canSubmit);
        if (canSubmit) {
            $(this).unbind('submit').submit();
        } else {
            deleteItemForm = this;
            $(domSlt.deleteItemName).text($(this).data('item-name'));
            $(domSlt.deleteItemModal).modal();
            e.preventDefault();
        }
    })

    $(domSlt.deleteItemModalSaveBtn).click(function (e) {
        $(deleteItemForm).data('can-submit', 'true');
        $(deleteItemForm).submit();
    });
}

function setCropperImage() {
    let aspectRatio = 1;
    switch (getController()) {
        case 'book':
            aspectRatio = 2 / 3;
            break;
    }
    domSlt.image.cropper({
        aspectRatio: aspectRatio,
        background: false,
        autoCropArea: 1,
    });
}

function getController() {
    return domSlt.controllerMeta.attr('content');
}

function getPluralController() {
    let controller = getController().replace(/y$/, 'ie');
    return controller + 's';
}
