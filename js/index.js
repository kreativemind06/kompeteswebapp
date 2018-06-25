// Resize to mobile to see the nav

// Aaron Layton
// https://twitter.com/aaronlayton


//-------------------------------------//
// init Masonry

var $grid = $('#photo_wrapper').masonry({
    itemSelector: 'none', // select none at first
    columnWidth: '.grid__col-sizer',
    gutter: '.grid__gutter-sizer',
    percentPosition: true,
    stagger: 5,
    // nicer reveal transition
    visibleStyle: { transform: 'translateY(0)', opacity: 1 },
    hiddenStyle: { transform: 'translateY(100px)', opacity: 0 },
});

// get Masonry instance
var msnry = $grid.data('masonry');

// initial items reveal
$grid.imagesLoaded( function() {
    $grid.removeClass('are-images-unloaded');
    $grid.masonry( 'option', { itemSelector: '.photo_row' });
    var $items = $grid.find('.photo_row');
    $grid.masonry( 'appended', $items );
});

//-------------------------------------//
// hack CodePen to load pens as pages

var nextPenSlugs = [
    '202252c2f5f192688dada252913ccf13',
    'a308f05af22690139e9a2bc655bfe3ee',
    '6c9ff23039157ee37b3ab982245eef28',
];

function getPenPath() {
    var slug = nextPenSlugs[ this.loadCount ];
    if ( slug ) {
        return 'https://s.codepen.io/desandro/debug/' + slug;
    }
}

//-------------------------------------//
// init Infinte Scroll

$grid.infiniteScroll({
    path: getPenPath,
    append: '.photo_row',
    outlayer: msnry,
    status: '.page-load-status',
});