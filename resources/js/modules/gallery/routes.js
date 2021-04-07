/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const routes = [
    {
        path: '/admin/galleries',
        name: 'Galleries',
        component: page('GalleryList'),
    },
    {
        path: '/admin/galleries/:id',
        name: 'Show Gallery',
        component: page('GalleryView'),
        hidden: true
    }
]
