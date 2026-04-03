<div>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css" rel="stylesheet">

    <div
        wire:ignore
        x-data="{
            calendar: null,
            init() {
                const calendarEl = this.$refs.calendar;

                this.calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    editable: true,
                    selectable: true,
                    displayEventTime: false,

                    events: (info, success) => {
                        this.$wire.fetchEvents().then(events => success(events));
                    }
                });

                this.calendar.render();
            }
        }"
    >
        <div x-ref="calendar"></div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js"></script>
    @endpush
</div>
