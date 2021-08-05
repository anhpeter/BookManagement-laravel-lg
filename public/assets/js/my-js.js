let domSlt = {
    deleteItemForm: '.delete-item-form',
    deleteItemModal: '#delete-item-modal',
    get deleteItemName() { return `${this.deleteItemModal} .item-name` },
    get deleteItemModalSaveBtn() { return `${this.deleteItemModal} .save-btn` },
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
}

let deleteItemForm = null;
function deleteItemHandler() {
    $(domSlt.deleteItemForm).submit(function (e) {
        let canSubmit = $(this).data('can-submit') == 'true';
        console.log(canSubmit);
        if (canSubmit) {
            $(this).unbind('submit').submit();
        }else{
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