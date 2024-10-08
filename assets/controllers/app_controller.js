import { Controller } from '@hotwired/stimulus';
import updateQueryString from "../util/updateQueryString.js";

export default class extends Controller {
    static targets = [
        'buffsJson',
        'pointsMax',
        'pointsAssigned',
        'template',
        'chatMessage',
        'copySuccess',
    ];

    buffs = [];
    pointsMax = 0;

    connect() {
        this.buffs = JSON.parse(this.buffsJsonTarget.value);
        this.pointsMax = parseInt(this.pointsMaxTarget.innerHTML, 10);

        // Update UI

        const pointsAssigned = this._countPointsAssigned(this.buffs);
        this._updateUI(this.buffs, pointsAssigned, this.pointsMax);
        this._updateChatMessage(this.buffs);
    }

    selectBuff({ params }) {
        const { action, buffid } = params;

        const selectedBuff = this.buffs.find(buff => buff.id === buffid);

        // Check values

        const currentPointsAssigned = this._countPointsAssigned(this.buffs);
        if (!this._validatePointsAssignment(action, selectedBuff.cost, currentPointsAssigned, this.pointsMax)
            || !this._validateBuffAssignment(action, selectedBuff.assignments, selectedBuff.maxAssignments)) {
            return;
        }

        // Update values

        selectedBuff.assignments = this._modifyBuffAssignment(action, selectedBuff.assignments);

        // Update UI

        const pointsAssigned = this._countPointsAssigned(this.buffs);
        this._updateUI(this.buffs, pointsAssigned, this.pointsMax);
        this._updateChatMessage(this.buffs);
    }

    clearAll() {
        this.buffs.forEach(buff => {
            buff.assignments = 0;
        });

        const pointsAssigned = this._countPointsAssigned(this.buffs);
        this._updateUI(this.buffs, pointsAssigned, this.pointsMax);
        this._updateChatMessage(this.buffs);
    }

    copyToClipboard() {
        const clipText = this.chatMessageTarget.value;
        if (clipText) {
            navigator.clipboard.writeText(clipText).then(() => {
                this.copySuccessTarget.innerHTML = `Copied to clipboard:<br>${clipText}`;
                this.copySuccessTarget.classList.remove('hidden');
                setTimeout(() => {
                    this.copySuccessTarget.classList.add('hidden');
                }, 5000);
            });
        }
    }

    saveToUrl() {
        const buffs = [];

        this.buffs.forEach((buff) => {
            buffs.push(buff.assignments);
        });

        const url = updateQueryString(false, 'q', buffs.join('|'));
        history.pushState({}, '', url);
    }

    applyTemplate() {
        this._updateChatMessage(this.buffs);
    }

    resetTemplate() {
        this.templateTarget.value = '/tt Could you buff me with %Buffs%, please?';
        this._updateChatMessage(this.buffs);
    }

    _validateBuffAssignment(action, currentAssignments, maxAssignments) {
        if (action === 'increase') {
            if (currentAssignments < maxAssignments) {
                return true;
            }
        } else {
            if (currentAssignments > 0) {
                return true;
            }
        }
        return false;
    }

    _modifyBuffAssignment(action, currentAssignments) {
        if (action === 'increase') {
            return currentAssignments + 1;
        }
        return currentAssignments - 1;
    }

    _validatePointsAssignment(action, cost, currentPointsAssigned, maxPointsAssigned) {
        if (action === 'increase') {
            if (currentPointsAssigned + cost <= maxPointsAssigned) {
                return true;
            }
        } else {
            if (currentPointsAssigned - cost >= 0) {
                return true;
            }
        }
        return false;
    }

    _countPointsAssigned(buffs) {
        let pointsAssigned = 0;

        buffs.forEach(buff => {
            pointsAssigned += buff.assignments * buff.cost;
        });

        return pointsAssigned;
    }

    _updateUI(buffs, currentPointsAssigned, maxPointsAssigned) {
        this.pointsAssignedTarget.innerHTML = currentPointsAssigned;

        buffs.forEach(buff => {
            document.getElementById('assignments_' + buff.id).innerHTML = buff.assignments;

            const decreaseBuffButton = document.getElementById('assignments_' + buff.id + '_decrease');
            decreaseBuffButton.toggleAttribute('disabled', !buff.assignments);

            const increaseBuffButton = document.getElementById('assignments_' + buff.id + '_increase');
            increaseBuffButton.toggleAttribute('disabled', buff.assignments >= buff.maxAssignments || currentPointsAssigned + buff.cost > maxPointsAssigned);

            const buffStrength = buff.assignments * buff.effect;
            document.getElementById('assigned_' + buff.id + '_strength').innerHTML = `${buffStrength}`;

            const selectedBuffContainer = document.getElementById('assigned_' + buff.id + '_container');
            selectedBuffContainer.classList.toggle('hidden', !buff.assignments);
        });
    }

    _updateChatMessage(buffs) {
        const buffTextParts = [];

        buffs.forEach(buff => {
            if (buff.assignments > 0) {
                buffTextParts.push(`${buff.name} (${buff.assignments}/${buff.maxAssignments})`);
            }
        });

        if (buffTextParts.length === 0) {
            this.chatMessageTarget.value = '';
            return;
        }

        let buffText   = '';
        let buffTextLC = '';
        buffTextParts.forEach((textPart, index) => {
            if (index === 0) {
                buffText += textPart;
                buffTextLC += textPart.toLowerCase();
            } else if (index === buffTextParts.length - 1) {
                buffText += ` and ${textPart}`;
                buffTextLC += ` and ${textPart.toLowerCase()}`;
            } else {
                buffText += `, ${textPart}`;
                buffTextLC += `, ${textPart.toLowerCase()}`;
            }
        });

        this.chatMessageTarget.value = this.templateTarget.value
            .replace('%Buffs%', buffText)
            .replace('%buffs%', buffTextLC);
    }
}
