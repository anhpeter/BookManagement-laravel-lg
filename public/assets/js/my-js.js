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
    domSlt.image.cropper({
        aspectRatio: 1/1,
        background: false,
        autoCropArea: 1,
    });
}