<script>
//save scrolling
window.onbeforeunload = function() {
    let currentPath = getCurrentPath();
    let storedPath = localStorage.getItem('storedPath');
    if (storedPath === currentPath) {
        if(<?= isset($_GET['comment']) ?>) {
            localStorage.setItem('scrollPosition', (document.getElementById('commentArea').offsetTop - 100).toString());
        } else {
            localStorage.setItem('scrollPosition', window.scrollY.toString());
        }
    }
};

window.onload = function() {
    let currentPath = getCurrentPath();
    let storedPath = localStorage.getItem('storedPath');
    if (storedPath === currentPath) {
        let storedScrollPosition = localStorage.getItem('scrollPosition');
        if (storedScrollPosition) {
            let scrollPosition = parseInt(storedScrollPosition) || 0;
            setTimeout(function() {
                window.scrollTo(0, scrollPosition);
                localStorage.removeItem('scrollPosition');
            }, 0);
        }
    }

    localStorage.setItem('storedPath', currentPath);
};

function getCurrentPath() {
    return window.location.pathname;
}

//sort by for /slams
document.addEventListener('DOMContentLoaded', function() {
    const sortBySelect = document.getElementById('sort_by');

    if (sortBySelect) {
        sortBySelect.addEventListener('change', function() {
            document.getElementById("slamsForm").submit();
        });
    }
});

</script>
