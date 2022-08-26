import { Link } from '@inertiajs/inertia-vue3';

export default {
    data() {
        return {
            columns: [

                // NAME COLUMN
                {
                    title: 'Сайт',
                    key: 'name',
                    sortable: true,
                    render: (h, { row }) => {
                        return h('div',
                            {
                                class: 'flex items-center space-x-2',
                            },
                            [
                                h('div', {
                                    style: {
                                        background: this.rowAcceptColorClass(row.accepted, row.tests)
                                    },
                                    class: 'w-8 h-8 rounded-full border'
                                }),
                                h('a', {
                                    href: row.url,
                                    target: '_blank'
                                }, row.name)
                            ]
                        );
                    }
                },

                // TESTS COLUMN
                {
                    title: 'Состояние',
                    key: 'tests',
                    sortable: true,
                    render: (h, { row }) => {
                        if (row.accepted && row.tests) {
                            return h('div', [
                                h('span', `Успешных проверок ${row.accepted} из ${row.tests}`),
                            ]);
                        }

                        return h('div', [
                            h('span', `Нет данных о проверках`),
                        ]);
                    }
                },

                // ACTION COLUMN
                {
                    title: ' ',
                    key: 'action',
                    width: 160,
                    render: (h, { row }) => {
                        return h('div', [
                            h(Link, {
                                // TODO route
                                href: route('sitepages', row.id)
                            }, () => [
                                h('span', 'Подробнее...')
                            ]),
                        ]);
                    }
                }

            ]
        }
    },

    methods: {
        rowAcceptColorClass(accepted, tests) {
            if (!tests) {
                return 'transparent'
            }

            const paletDiff = [[510, 0, 0], [0, 510, 0]];

            if (accepted > tests) accepted = tests;
            if (!accepted) accepted = 0;

            const dr = paletDiff[0][0] - ((paletDiff[0][0] - paletDiff[1][0]) * accepted / tests);
            const dg = paletDiff[0][1] - ((paletDiff[0][1] - paletDiff[1][1]) * accepted / tests);

            const r = dr > 255 ? 255 : dr;
            const g = dg > 255 ? 255 : dg;

            return `rgb(${r}, ${g}, 0)`;
        }
    }
};
