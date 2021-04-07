/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const routes = [
    {
        path: '/admin/tips',
        name: 'Tips',
        component: page('TipList'),
    },
    {
        path: '/admin/tips/:id',
        name: 'Show Tip',
        component: page('TipView'),
        hidden: true
    }
]
