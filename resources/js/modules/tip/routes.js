/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const routes = [
    {
        path: '/tips',
        name: 'Tips',
        component: page('TipList'),
    },
    {
        path: '/tips/:id',
        name: 'Show Tip',
        component: page('TipView'),
        hidden: true
    }
]
