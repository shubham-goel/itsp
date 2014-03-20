jQuery(".modal-backdrop, #modal1 .close, #modal1 .btn").live("click", function() {
        jQuery("#modal1 iframe").attr("src", jQuery("#modal1 iframe").attr("src"));
});
jQuery(".modal-backdrop, #modal2 .close, #modal2 .btn").live("click", function() {
        jQuery("#modal2 iframe").attr("src", jQuery("#modal2 iframe").attr("src"));
});

jQuery(".modal-backdrop, #modal3 .close, #modal3 .btn").live("click", function() {
        jQuery("#modal3 iframe").attr("src", jQuery("#modal3 iframe").attr("src"));
});
$('.carousel').carousel({
    interval: 2000,
    pause:'hover'
    });

/*
    Filterable portfolio
*/
jQuery(document).ready(function() {
    $clientsHolder = $('ul.archives-img');
    $clientsClone = $clientsHolder.clone(); 
 
    $('.filter-archives a').click(function(e) {
        e.preventDefault();
        $filterClass = $(this).attr('class');
 
        $('.filter-archives a').attr('id', '');
        $(this).attr('id', 'active-imgs');
 
        if($filterClass == 'all'){
            $filters = $clientsClone.find('li');
        }
        else {
            $filters = $clientsClone.find('li[data-type~='+ $filterClass +']');
        }
 
        $clientsHolder.quicksand($filters, {duration: 700}, function() {
            $("a[rel^='prettyPhoto']").prettyPhoto({social_tools: false});
        });
    });
});

