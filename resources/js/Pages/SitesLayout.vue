<template lang='pug'>
Head(title="Sites Layout")

BreezeAuthenticatedLayout
    .container
        Card.mb-4.rounded-xl
            h3.mb-4.text-lg.font-semibold Добавить сайт

        h3.mb-4.mx-4.text-lg.font-semibold Добавленные сайты
        Table(
            :columns='columns'
            :data='data'
            :loading='loading'
        )
</template>

<script>
// TODO remove 'items' and get 'data' from server
const items = [
    { path: 'site-common.com', tests: 10, accepted: 4 },
    { path: 'site-common.com', tests: 10, accepted: 5 },
    { path: 'www.google.com', tests: 10, accepted: 8 },
    { path: 'site-common.com', tests: 10, accepted: 7 },
    { path: 'www.google.com', tests: 10, accepted: 9 },
    { path: 'site-common.com', tests: 10, accepted: 3},
    { path: 'site-common.com', tests: 10, accepted: 6 },
    { path: 'gihub.com', tests: 10, accepted: 1 },
    { path: 'site-common.com', tests: 10, accepted: 2 },
    { path: 'www.google.com', tests: 10, accepted: 10 },
];

export default {
    name: 'SitesLayout',
    data() {
        return {
            loading: false,
            columns: [
                {
                    title: 'Адрес',
                    key: 'path',
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
                                    class: 'w-8 h-8 rounded-full'
                                }),
                                h('a', {
                                    href: row.path,
                                    target: '_blank'
                                }, row.path)
                            ]
                        );
                    }
                },
                {
                    title: 'Состояние',
                    key: 'accepted',
                    sortable: true,
                    render: (h, { row }) => {
                        return h('div', [
                            h('span', `Успешных проверок ${row.accepted} из ${row.tests}`),
                        ]);
                    }
                },
                {
                    title: ' ',
                    key: 'action',
                    fixed: 'right',
                    width: 160,
                    render: (h, params) => {
                        return h('div', [
                            h('a', {
                                args: {
                                    // TODO route
                                    href: route('')
                                }
                            }, 'Подробнее...'),
                        ]);
                    }
                },
            ],
            data: items
        }
    },
    methods: {
        loadSites() {

        },

        addSite() {

        },

        rowAcceptColorClass(accepted, tests) {
            const paletDiff = [[510, 0, 0], [0, 510, 0]];

            if (accepted > tests) accepted = tests;

            const dr = paletDiff[0][0] - ((paletDiff[0][0] - paletDiff[1][0]) * accepted / tests);
            const dg = paletDiff[0][1] - ((paletDiff[0][1] - paletDiff[1][1]) * accepted / tests);

            const r = dr > 255 ? 255 : dr;
            const g = dg > 255 ? 255 : dg;

            return `rgb(${r}, ${g}, 0)`;
        }
    }
}
</script>
