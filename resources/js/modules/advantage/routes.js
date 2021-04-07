/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const routes = [
    {
        path: '/admin/advantages',
        name: 'Advantages',
        component: page('AdvantageList'),
    },
    {
        path: '/admin/advantages/:id',
        name: 'Show Advantage',
        component: page('AdvantageView'),
        hidden: true
    }
]
