import './bootstrap';

import { Animate, Carousel, Datepicker, Input, initTE, Offcanvas, Ripple, Dropdown, Collapse, Select, Chip, ChipsInput, Tooltip, Modal, Toast } from "tw-elements";
initTE({ Animate, Carousel, Datepicker, Input, Offcanvas, Ripple, Dropdown, Collapse, Select, Chip, ChipsInput, Tooltip, Modal, Toast }, { allowReinits: true });

import Splide from '@splidejs/splide';
window.Splide = Splide;

import Dropzone from 'dropzone';
window.dz = Dropzone;

import JQuery from 'jquery';
window.$ = JQuery;

import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.start();



