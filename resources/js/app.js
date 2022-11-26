import './bootstrap';

// https://laravel.com/docs/9.x/vite#blade-processing-static-assets
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

import hotwiredTurbo from 'https://cdn.skypack.dev/@hotwired/turbo';

import { Application, Controller } from "https://unpkg.com/@hotwired/stimulus/dist/stimulus.js"
window.Stimulus = Application.start()

Stimulus.register("people-search", class extends Controller {
  static targets = [ "turboframe" ]

  input(event) {
    const action = event.target.form.action
    const query = event.target.value
    const url = action + '?search=' + query
    this.turboframeTarget.src = url
  }
})

