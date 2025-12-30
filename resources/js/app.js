import './bootstrap';
import './features/forms';
import './components/datepickers.js';
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
import printImage from "./features/print.js";

Alpine.data('printImage', printImage);

Livewire.start();
