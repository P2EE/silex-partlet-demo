var tags = document.getElementsByTagName('html');
if(tags[0]){
    tags[0].setAttribute('class', 'js');
}

require.config({
    baseUrl: '/assets/js',
    paths: {
        "jquery": "jquery-2.0.3.min",
        "bootstrap": "bootstrap-3.0.0.min"
    }
});

require(['jquery', 'bootstrap']);
