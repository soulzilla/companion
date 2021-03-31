/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const routes = [
    {
        path: '/admin/maps',
        name: 'Maps',
        component: page('MapList'),
        iconCls: 'el-icon-map-location'
    },
    {
        path: '/admin/maps/:id',
        name: 'Show Map',
        component: page('MapView'),
        hidden: true
    }
]
