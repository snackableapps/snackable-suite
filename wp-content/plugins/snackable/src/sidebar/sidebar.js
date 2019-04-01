/**
 * BLOCK: snackable-quiz
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

// const { __ } = wp.i18n; // Import __() from wp.i18n
// const { registerPlugin } = wp.plugin; // Import registerBlockType() from wp.blocks
// const { InnerBlocks } = wp.editor;
// const { Component } = wp.element;
// const { select } = wp.data;

console.log('WP:', wp.plugins)

// const PLUGIN_NAME = 'snackable/plugin-snackable-quiz';
// registerPlugin(PLUGIN_NAME, {
//     render: function() {
//         return <PluginSidebar
//                     name={PLUGIN_NAME}
//                     icon="admin-post"
//                     title="Snackable Quiz Sidebar"
//                 >
//                     Meta field
//                 </PluginSidebar>;
//     },
// } );