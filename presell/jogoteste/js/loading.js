/* eslint-disable prefer-template */
/* eslint-disable func-names */
/* eslint-disable no-var */

function LoadingBar() {
    var showing = false;
    var width = 300;
    var height = 30;
    var border = 4;
    var total = 0;

    var container = document.createElement('div');
    var base = document.createElement('div');
    var bar = document.createElement('div');
    var label = document.createElement('div');

    function initializeElement(element, styles) {
        for (var style in styles) {
            if (styles.hasOwnProperty(style)) {
                element.style[style] = styles[style];
            }
        }
        return element;
    }

    function createAndAppendElement(parent, child, styles) {
        var element = initializeElement(document.createElement(child), styles);
        parent.appendChild(element);
        return element;
    }

    function resize() {
        container.style.left = ((window.innerWidth * 0.5) - (width * 0.5)) + 'px';
        container.style.top = ((window.innerHeight * 0.5) + 120) + 'px';
    }

    function show() {
        if (showing) return;
        showing = true;
        document.body.appendChild(container);
        window.addEventListener('resize', resize);
        setProgress(0);
        resize();
    }

    function hide() {
        if (!showing) return;
        showing = false;
        container.remove();
        window.removeEventListener('resize', resize);
    }

    function setTotal(mbs) {
        total = mbs;
    }

    function setProgress(ratio) {
        ratio = Math.min(1, Math.max(0, ratio));

        var barMaxWidth = width - (border * 2);
        var percent = Math.round(ratio * 100) + '%';

        bar.style.width = (barMaxWidth * ratio) + 'px';

        if (total) {
            var loaded = (total * ratio).toFixed(1);
            var mbs = loaded + '/' + total + ' MB';
            label.innerText = percent + ' - ' + mbs;
        } else {
            label.innerText = percent;
        }
    }

    container = initializeElement(container, {
        position: 'fixed',
        width: width + 'px',
        height: height + 'px',
        zIndex: 999,
    });

    base = createAndAppendElement(container, 'div', {
        position: 'absolute',
        width: width + 'px',
        height: height + 'px',
        backgroundColor: 'rgba(0, 0, 0, 0.75)',
    });

    bar = createAndAppendElement(container, 'div', {
        position: 'absolute',
        left: border + 'px',
        top: border + 'px',
        width: (width - (border * 2)) + 'px',
        height: (height - (border * 2)) + 'px',
        backgroundColor: '#f65000',
    });

    label = createAndAppendElement(container, 'div', {
        position: 'fixed',
        width: width + 'px',
        height: height + 'px',
        lineHeight: height + 'px',
        textAlign: 'center',
        color: '#FFFFFF',
        fontWeight: 'bold',
        fontSize: '12px',
        fontFamily: '"Verdana", sans-serif',
    });

    show();
    this.show = show;
    this.hide = hide;
    this.setTotal = setTotal;
    this.setProgress = setProgress;
}

window.loadingBar = new LoadingBar();
