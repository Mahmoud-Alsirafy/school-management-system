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
                    },

                    // Add new event
                    dateClick: (info) => {
                        const title = prompt('عنوان الحدث');
                        if (!title) return;

                        this.$wire.addevent({
                            title,
                            start: info.dateStr
                        }).then(() => {
                            this.calendar.refetchEvents();
                        });
                    },

                    // Drag & drop to update date
                    eventDrop: (info) => {
                        this.$wire.updateEvent(info.event.id, info.event.startStr)
                            .then(() => {
                                this.calendar.refetchEvents();
                            });
                    },

                    // Click on event to delete
                    eventClick: (info) => {
                        if (!confirm('تحب تحذف الحدث ده؟')) return;

                        this.$wire.deleteEvent(info.event.id)
                            .then(() => {
                                this.calendar.refetchEvents();
                            });
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
