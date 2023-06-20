jQuery(document).ready(function($) {
    if (typeof(Storage) !== 'undefined') {
        var modalDisplayed = sessionStorage.getItem('modalDisplayed');
        if (!modalDisplayed) {
            openModal();
            sessionStorage.setItem('modalDisplayed', 'true');
        }
    }
});

// 모달 열기
function openModal() {
    jQuery('#password-modal').show();
}

// 모달 닫기
function closeModal() {
    jQuery('#password-modal').hide();
}

// 모달 창이 외부 클릭 시 닫힘
jQuery(document).on('click', function(event) {
    var modal = jQuery('#password-modal');
    if (event.target == modal[0]) {
        closeModal();
    }
});
