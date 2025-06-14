/**
 * WordPress dependencies
 */
import {
	useState,
	useMemo,
	useContext,
	createContext,
} from '@wordpress/element';

/**
 * Internal dependencies
 */
import { useEventListener } from '../../react-hooks';
import { updateQueryString, getParam } from './url-functions';

/**
 * Query string router context.
 */
const QueryStringRouterContext = createContext();

/**
 * Query string router component.
 * It creates a provider with the following values in the context:
 * - `currentRoute`: The string of the current route.
 * - `goNext`: Function that send the user to the next route.
 * - `goTo`: Function that send the user to another route.
 *
 * @param {Object}   props
 * @param {string}   props.paramName    Param used as reference in the query string.
 * @param {string[]} props.routes       Routes of the navigation.
 * @param {string}   props.defaultRoute Default route to open if there is nothing in the URL.
 * @param {Object}   props.children     Render this children if it matches the route.
 */
const QueryStringRouter = ( { paramName, routes, defaultRoute, children } ) => {
	// Current route.
	const [ currentRoute, setRoute ] = useState( getParam( paramName ) );

	// Provider value.
	const providerValue = useMemo( () => {
		/**
		 * Function that send the user to another route.
		 * It changes the URL and update the state of the current route.
		 *
		 * @param {string}  newRoute New route to send the user.
		 * @param {boolean} replace  Flag to mark if should replace or push state.
		 */
		const goTo = ( newRoute, replace = false ) => {
			updateQueryString( paramName, newRoute, replace );
			setRoute( newRoute );
		};

		/**
		 * Function that send the user to the next route, in a linear navigation.
		 * It changes the URL and update the state of the current route.
		 */
		const goNext = () => {
			const currentIndex = routes.findIndex(
				( route ) => route === currentRoute
			);
			const nextRoute = routes[ currentIndex + 1 ];

			if ( nextRoute ) {
				goTo( nextRoute );
			}
		};

		if ( ! currentRoute ) {
			goTo( defaultRoute, true );
		}

		return {
			currentRoute,
			goNext,
			goTo,
		};
	}, [ currentRoute, paramName, routes, defaultRoute ] );

	// Handle history changes through popstate.
	useEventListener(
		'popstate',
		() => {
			setRoute( getParam( paramName ) );
		},
		[ paramName ]
	);

	return (
		<QueryStringRouterContext.Provider value={ providerValue }>
			{ children }
		</QueryStringRouterContext.Provider>
	);
};

export default QueryStringRouter;

/**
 * Export `Route` component as part of the query string router.
 */
export { default as Route } from './route';

/**
 * Hook to access the query string router values from the context.
 *
 * @return {QueryStringRouterContext} Query string router context.
 *
 * @typedef  {Object}           QueryStringRouterContext
 * @property {string}   currentRoute Current route.
 * @property {Function} goTo         Function to navigate between routes.
 */
export const useQueryStringRouter = () =>
	useContext( QueryStringRouterContext );
