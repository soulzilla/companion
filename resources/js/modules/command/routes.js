/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const routes = [
    {
        path: '/commands',
        name: 'Commands',
        component: page('CommandList'),
    },
    {
        path: '/commands/:id',
        name: 'Show Command',
        component: page('CommandView'),
        hidden: true
    }
]
