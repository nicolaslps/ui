import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["item", "trigger", "indicator", "content"];

    static values = {
        multiple: { type: Boolean, default: false },
        disabled: { type: Boolean, default: false },
    };

    toggled(event) {
        const item = event.currentTarget;
        const state = item.open ? "open" : "closed";

        item.dataset.state = state;
        for (const part of [...this.triggerTargets, ...this.indicatorTargets, ...this.contentTargets]) {
            if (part.closest("details") === item) {
                part.dataset.state = state;
            }
        }

        this.dispatch("change", { detail: { value: this.value } });
    }

    guard(event) {
        const item = event.currentTarget.closest("details");

        if (this.disabledValue || item.hasAttribute("data-hui-disabled")) {
            event.preventDefault();
        }
    }

    navigate(event) {
        if (!["ArrowDown", "ArrowUp", "Home", "End"].includes(event.key)) {
            return;
        }

        const triggers = this.triggerTargets;
        const index = triggers.indexOf(event.currentTarget);
        if (index === -1) {
            return;
        }

        event.preventDefault();
        const target = {
            ArrowDown: (index + 1) % triggers.length,
            ArrowUp: (index - 1 + triggers.length) % triggers.length,
            Home: 0,
            End: triggers.length - 1,
        }[event.key];
        triggers[target]?.focus();
    }

    get value() {
        return this.itemTargets.filter((item) => item.open).map((item) => item.dataset.value);
    }
}
