import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["image", "fallback"];

    connect() {
        for (const image of this.imageTargets) {
            if (image.complete && image.naturalWidth > 0) {
                this.reveal(image);
            }
        }
    }

    loaded(event) {
        this.reveal(event.currentTarget);
    }

    reveal(image) {
        image.classList.remove("hidden");
        for (const fallback of this.fallbackTargets) {
            fallback.classList.add("hidden");
        }
    }
}
