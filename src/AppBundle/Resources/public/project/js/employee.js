var $collectionAddressHolder;
var $addAddressLink = $('<a href="#" class="add_address_link">Add a address</a>');
var $addPhoneLink = $('<a href="#" class="add_phone_link">Add a Phone</a>');

jQuery(document).ready(function() {

    $collectionAddressHolder = $('div#employee_addresses');
    $collectionAddressHolder.append($addAddressLink);
    $collectionAddressHolder.data('index', $collectionAddressHolder.find(':input').length);

    $addAddressLink.on('click', function(e) {
        e.preventDefault();
        addForm($collectionAddressHolder, $addAddressLink);
        addTagFormDeleteLink($('div', $collectionAddressHolder).last());
    });

    $collectionPhoneHolder = $('div#employee_phones');
    $collectionPhoneHolder.append($addPhoneLink);
    $collectionPhoneHolder.data('index', $collectionPhoneHolder.find(':input').length);
    $addPhoneLink.on('click', function(e) {
        e.preventDefault();
        addForm($collectionPhoneHolder, $addPhoneLink);
        addTagFormDeleteLink($('div', $collectionPhoneHolder).last());
    });
});

function addForm($collectionHolder, $newLink) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);
    newForm = newForm.replace(/label__/g, '');
    $collectionHolder.data('index', index + 1);
    $newLink.before(newForm);
}



jQuery(document).ready(function() {
    $collectionHolder = $('div#employee_addresses');
    $collectionHolder.find('input').parent().each(function() {
        addTagFormDeleteLink($(this));
    });
    $collectionHolder = $('div#employee_phones');
    $collectionHolder.find('input').parent().each(function() {
        addTagFormDeleteLink($(this));
    });
});



function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#">delete this element</a>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        e.preventDefault();
        $tagFormLi.parent().parent().remove();
    });
}