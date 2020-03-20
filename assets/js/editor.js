$(function() {
    if($('#wmd-button-row').length>0){
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-owo-button" style="" title="插入表情"><span class="OwO"></span></li>');
        var owo = new OwO({
            logo: 'OωO',
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementById('text'),
            api: '/usr/themes/Miracles/assets/OwO.json',
            position: 'down',
            width: '400px',
            maxHeight: '250px'
        });
    }
});