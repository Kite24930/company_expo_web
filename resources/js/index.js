import './common.js';
import { Accordion } from "flowbite";
import 'viewerjs/dist/viewer.min.css';
import Viewer from 'viewerjs';

const accordionEl = document.getElementById('time_table');

const accordionItems = [
    {
        id: 'period_1_head',
        triggerEl: document.getElementById('period_1_head'),
        targetEl: document.getElementById('period_1_body'),
        active: false,
    },
    {
        id: 'period_2_head',
        triggerEl: document.getElementById('period_2_head'),
        targetEl: document.getElementById('period_2_body'),
        active: false,
    }
];

const options = {
    alwaysOpen: false,
    activeClasses: 'bg-blue-100 text-blue-500 rounded-t-lg',
    inactiveClasses: 'rounded-lg',
    onOpen: (item) => {
        console.log('accordion item has been shown');
        console.log(item);
    },
    onClose: (item) => {
        console.log('accordion item has been hidden');
        console.log(item);
    },
    onToggle: (item) => {
        console.log('accordion item has been toggled');
        console.log(item);
    },
}

const accordion = new Accordion(accordionEl, accordionItems, options);

const viewer = new Viewer(document.getElementById('floor_map'));
