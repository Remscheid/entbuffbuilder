import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [
        'buffsJson',
        'pointsMax',
        'pointsAssigned',
    ];

    buffs = [];
    pointsMax = 0;
    pointsAssigned = 0;

    connect() {
        this.buffs = JSON.parse(this.buffsJsonTarget.value);
        console.log('buffsSource: ', this.buffs);
        this.pointsMax = parseInt(this.pointsMaxTarget.innerHTML, 10);
    }

    selectBuff({ params }) {
        const { action, buffid } = params;

        const selectedBuff = this.buffs.find(buff => buff.id === buffid);

        // Check values

        if (!this._checkPointsAssigned(action, selectedBuff.cost, this.pointsAssigned, this.pointsMax) ||
            !this._checkBuffAssignment(action, selectedBuff.assignments, selectedBuff.maxAssignments)) {
            return;
        }

        // Update values

        selectedBuff.assignments = this._calculateBuffAssignment(action, selectedBuff.assignments);
        this.pointsAssigned = this._calculatePointsAssigned(action, selectedBuff.cost, this.pointsAssigned);

        // Update UI

        this._updateUI(this.buffs, this.pointsAssigned, this.pointsMax);
    }

    clearAll() {
        this.pointsAssigned = 0;
        this.buffs.forEach(buff => {
            buff.assignments = 0;
        });

        this._updateUI(this.buffs, this.pointsAssigned, this.pointsMax);
    }

    _checkBuffAssignment(action, currentAssignments, maxAssignments) {
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

    _calculateBuffAssignment(action, currentAssignments) {
        if (action === 'increase') {
            return currentAssignments + 1;
        }
        return currentAssignments - 1;
    }

    _checkPointsAssigned(action, cost, currentPointsAssigned, maxPointsAssigned) {
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

    _calculatePointsAssigned(action, cost, currentPointsAssigned) {
        if (action === 'increase') {
            return currentPointsAssigned + cost;
        }
        return currentPointsAssigned - cost;
    }

    _updateUI(buffs, currentPointsAssigned, maxPointsAssigned) {
        this.pointsAssignedTarget.innerHTML = currentPointsAssigned;

        buffs.forEach(buff => {
            document.getElementById('assignments_' + buff.id).innerHTML = buff.assignments;

            const decreaseBuffButton = document.getElementById('assignments_' + buff.id + '_decrease');
            decreaseBuffButton.toggleAttribute('disabled', !buff.assignments);

            const increaseBuffButton = document.getElementById('assignments_' + buff.id + '_increase');
            increaseBuffButton.toggleAttribute('disabled', buff.assignments >= buff.maxAssignments || currentPointsAssigned >= maxPointsAssigned);

            const buffStrength = buff.assignments * buff.effect;
            document.getElementById('assigned_' + buff.id + '_strength').innerHTML = `${buffStrength}`;

            const selectedBuffContainer = document.getElementById('assigned_' + buff.id + '_container');
            selectedBuffContainer.classList.toggle('hidden', !buff.assignments);
        });
    }
}
