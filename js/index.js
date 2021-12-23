const projectContainer = $('.content-wrapper .inner-container.container .row .blog-masonry.masonry-true');
function setProjects(projects) {
    projects = JSON.parse(projects);
    projects.forEach(project => {
        const e = document.createElement('div');
        e.className = 'post-masonry col-md-4 col-sm-6';
        // categories
        var categoryRow = '';
        for (let i = 0; i < project['categories'].length; i++) {
            const c = project['categories'][i];
            categoryRow += `<a href="#">${c}</a>`;
            if (i < project['categories'].length - 1) categoryRow += ', ';
        }
        e.innerHTML = `
            <div class="blog-thumb">
                <img src="content/projects/${project['id']}/${project['thumb']}" alt="The project's thumbnail">
                <div class="overlay-b">
                    <div class="overlay-inner">
                        <a href="blog-single.html" class="fa fa-link"></a>
                    </div>
                </div>
            </div>
            <div class="blog-body">
                <div class="box-content">
                    <h3 class="post-title"><a href="#">${project['title']}</a></h3>
                    <span class="blog-meta">${categoryRow}</span>
                    ${project['description'] != '' ? `<p>${project['description']}</p>` : ''}
                </div>
            </div>`;
        $(projectContainer).append(e);
    });
}

$(window).load(function () {
    $('.loader-item').fadeOut();
    $('#pageloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({ 'overflow-y': 'visible' });
});