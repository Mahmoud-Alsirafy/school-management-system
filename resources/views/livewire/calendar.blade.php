<div
    x-data="calendarComponent()"
    x-init="init()"
    wire:ignore
>
    <div id="calendar"></div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js"></script>

<script>
function calendarComponent() {
    return {
        calendar: null,

        init() {
            const calendarEl = document.getElementById('calendar');

            const component = Livewire.find(
                document.querySelector('[wire\\:id]').getAttribute('wire:id')
            );

            this.calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                editable: true,
                selectable: true,
                displayEventTime: false,

                events: (info, success) => {
                    component.call('fetchEvents').then(events => success(events));
                },

                // Add new event
                dateClick: (info) => {
                    const title = prompt('عنوان الحدث');
                    if (!title) return;

                    component.call('addevent', {
                        title,
                        start: info.dateStr
                    }).then(() => {
                        this.calendar.refetchEvents();
                    });
                },

                // Drag & drop to update date
                eventDrop: (info) => {
                    component.call('updateEvent', info.event.id, info.event.startStr)
                        .then(() => {
                            this.calendar.refetchEvents();
                        });
                },

                // Click on event to delete
                eventClick: (info) => {
                    if (!confirm('تحب تحذف الحدث ده؟')) return;

                    component.call('deleteEvent', info.event.id)
                        .then(() => {
                            this.calendar.refetchEvents();
                        });
                }
            });

            this.calendar.render();
        }
    }
}
</script>
@endpush
