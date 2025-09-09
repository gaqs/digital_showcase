import './bootstrap';

import { Animate, Carousel, Datepicker, Input, initTE, Offcanvas, Ripple, Dropdown, Collapse, Select, Chip, ChipsInput, Tooltip, Modal, Toast } from "tw-elements";
initTE({ Animate, Carousel, Datepicker, Input, Offcanvas, Ripple, Dropdown, Collapse, Select, Chip, ChipsInput, Tooltip, Modal, Toast }, { allowReinits: true });

import Splide from '@splidejs/splide';
window.Splide = Splide;

//import AutoScroll from '@splidejs/splide-extension-auto-scroll';
//window.AutoScroll = AutoScroll;

import Dropzone from 'dropzone';
window.dz = Dropzone;

import JQuery, { trumbowyg } from 'jquery';
window.$ = JQuery;

import Alpine from 'alpinejs';
window.Alpine = Alpine;

import L from 'leaflet';
window.L = L;

import Quill from 'quill';
window.Quill = Quill;

Alpine.start();



