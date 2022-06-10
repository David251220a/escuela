require('./bootstrap');

import Alpine from 'alpinejs';
import elements from 'tw-elements';

import Swal from 'sweetalert2'

window.Alpine = Alpine;
window.elements = elements;
window.Swal = Swal;

Alpine.start();

