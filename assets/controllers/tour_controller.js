import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [
        'container',
        'content',
        'prevButton',
        'nextButton'
    ];

    steps = [
        {
            target: 'mainDialog',
            offsetX: 7,
            offsetY: 32,
            content: 'Welcome to the SWG Entertainer Buff Builder!<br>\n' +
                '<br>\n' +
                'This tool is intended to help you setup your desired entertainer buffs and supply you with a chat message that you can send to your fellow entertainer.<br>\n' +
                '<br>\n' +
                'For an introduction just follow this litte tour.',
        },
        {
            target: 'assignments',
            offsetX: 11,
            offsetY: 38,
            content: 'These are the buffs an entertainer has available. You can spend a total of 20 points by clicking on the plus buttons on the right.',
        },
        {
            target: 'selectedBuffs',
            offsetX: 12,
            offsetY: 35,
            content: 'This is the list with your selected buffs, showing you the summed up attribute changes.',
        },
        {
            target: 'copyToClipboardButton',
            offsetX: 0,
            offsetY: 35,
            content: 'The above text field contains a generated chat message that you can copy and paste into the ingame chat window.<br>\n' +
                '<br>\n' +
                'Note that "/tt" stands for "tell target", so make sure you target the entertainer when sending the message.',
        },
        {
            target: 'saveToUrlButton',
            offsetX: 0,
            offsetY: 35,
            content: 'With the "Save to URL" button you can append the current configuration to the URL, which you can then store as a bookmark.<br>\n' +
                '<br>\n' +
                'You could generate and store multiple bookmarks for different characters or activities.',
        },
        {
            target: 'applyTemplateButton',
            offsetX: 0,
            offsetY: 35,
            content: 'In this text field you can change the default template for the generated message. Change it to a sentence you like and click on "Apply template". Your changes are saved in your browser until you reset it with "Reset template".<br>\n' +
                '<br>\n' +
                'You can use different placeholders:<br>\n' +
                '&nbsp;&nbsp;%Buffs% for uppercase buff names<br>\n' +
                '&nbsp;&nbsp;%buffs% for lowercase buff names',
        },
        {
            target: 'mainDialog',
            offsetX: 6,
            offsetY: 31,
            content: 'This concludes the introduction tour. I hope you like this little tool.<br>\n' +
                '<br>\n' +
                'If you have any comments or questions you can find my contact details at the bottom of the page.',
        },
    ];

    currentStep = -1;

    connect() {
        this.contentTarget.innerHTML = '';
        if (localStorage.getItem('tourClosed') === '1') {
            this.currentStep = -1;
        } else {
            this.currentStep = 0;
            this._showTourItem(this.currentStep);
        }
    }

    tourShow() {
        localStorage.setItem('tourClosed', '0');
        this.currentStep = 0;
        this._showTourItem(this.currentStep);
    }

    tourClose() {
        localStorage.setItem('tourClosed', '1');
        this.currentStep = -1;
        this.containerTarget.classList.add('hidden');
        this.contentTarget.innerHTML = '';
    }

    tourPrev() {
        if (this.currentStep > 0) {
            this.currentStep--;
        }

        this._showTourItem(this.currentStep);
    }

    tourNext() {
        if (this.currentStep < this.steps.length - 1) {
            this.currentStep++;
        }

        this._showTourItem(this.currentStep);
    }

    _showTourItem(itemIndex) {
        const step = this.steps[itemIndex];

        this.contentTarget.innerHTML = step.content;
        
        this._updateButtons(itemIndex);

        this._positionTourItem(step);
    }

    _positionTourItem(step) {
        const tourEl = this.containerTarget;

        const anchorEl = document.getElementById(step.target);
        const anchorRect = anchorEl.getBoundingClientRect();
        const bodyRect = document.body.getBoundingClientRect();
        const offsetTop = anchorRect.top - bodyRect.top;
        const offsetLeft = anchorRect.left - bodyRect.left;
        const margin = 28;

        setTimeout(() => {
            tourEl.style.left = (offsetLeft + step.offsetX) + 'px';
            tourEl.style.top = (offsetTop + step.offsetY - margin) + 'px';

            this._animateTourItem(tourEl);
            tourEl.classList.remove('hidden');
        }, 10);
    }

    _animateTourItem(tourEl) {
        const clone = tourEl.cloneNode(true);
        clone.classList.add('tourClone', 'opacity-0', 'pointer-events-none');
        document.body.appendChild(clone);

        this._scrollIntoViewIfOutOfView(clone);

        setTimeout(() => {
            document.body.removeChild(clone);
        }, 160);
    }

    _scrollIntoViewIfOutOfView(tourEl) {
        const topOfPage = window.scrollY || document.documentElement.scrollTop || document.body.scrollTop;
        const heightOfPage = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

        let elY = 0;
        for(let p = tourEl; p && p.tagName !== 'BODY'; p = p.offsetParent){
            elY += p.offsetTop;
        }
        const elH = tourEl.offsetHeight;
        let options = { behavior: 'smooth', block: 'end' };
        if ((topOfPage + heightOfPage) < (elY + elH)) {
            options.block = 'end';
            tourEl.scrollIntoView(options);
        }
        else if (elY < topOfPage) {
            options.block = 'start';
            tourEl.scrollIntoView(options);
        }
    }

    _updateButtons(itemIndex) {
        if (itemIndex <= 0) {
            this.prevButtonTarget.classList.add('invisible');
        } else {
            this.prevButtonTarget.classList.remove('invisible');
        }

        if (itemIndex >= this.steps.length - 1) {
            this.nextButtonTarget.classList.add('invisible');
        } else {
            this.nextButtonTarget.classList.remove('invisible');
        }
    }
}
