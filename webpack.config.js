/**
 * `@wordpress/scripts` path-based name multi-block Webpack configuration.
 * @see https://wordpress.stackexchange.com/questions/390282
 */

// Native Depedencies.
const path = require( 'path' );

// Third-Party Dependencies.
const CopyPlugin = require( 'copy-webpack-plugin' );
const config = require( '@wordpress/scripts/config/webpack.config.js' );

/**
 * Resolve a series of path parts relative to `./src`.
 * @param string[] path_parts An array of path parts.
 * @returns string A normalized path, relative to `./src`.
 **/
const resolveSource = ( ...path_parts ) => path.resolve( process.cwd(), 'src', ...path_parts );

/**
 * Resolve a block name to the path to it's main `index.js` entry-point.
 * @param string name The name of the block.
 * @returns string A normalized path to the block's entry-point file.
 **/
const resolveBlockEntry = ( name ) => resolveSource( 'blocks', name, 'index.js' );

config.entry = {
  'blocks/block-1/index': resolveBlockEntry( 'block-1' ),
  'blocks/block-2/index': resolveBlockEntry( 'block-2' ),
  'blocks/block-3/index': resolveBlockEntry( 'block-3' ),
  'blocks/block-4/index': resolveBlockEntry( 'block-4' ),
  'framework/options/settings': resolveSource( 'framework/options', 'app.js' ),
  'framework/posts/index': resolveSource( 'framework/posts', 'SinglePostApp.js' ),
};

// Add a CopyPlugin to copy over block.json files.
config.plugins.push(
  new CopyPlugin(
    {
      patterns: [
        {
          context: 'src',
          from: `blocks/*/block.json`
        },
      ],
    }
  )
);

module.exports = config;