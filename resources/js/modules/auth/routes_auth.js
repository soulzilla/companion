/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const ROUTE_LOGIN = 'Login';

export default [
    {
        path: '/login',
        component: page('Login'),
        name: ROUTE_LOGIN,
        meta: {
            auth: false,
        },
    },
]
