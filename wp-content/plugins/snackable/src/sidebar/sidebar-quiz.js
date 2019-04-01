/**
 * BLOCK: snackable-quiz
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerPlugin } = wp.plugins; // Import registerBlockType() from wp.blocks
const { PluginSidebar, PluginSidebarMoreMenuItem  } = wp.editPost;
const { Fragment } = wp.element;
// const { select } = wp.data;

import { SnackalbeQuizList } from './sidebar-quiz-controls';
const { Panel, PanelBody, PanelRow } = wp.components;


const PLUGIN_NAME = 'plugin-snackable-quiz';
const TITLE = 'Snackable Quiz Sidebar'; 
registerPlugin(PLUGIN_NAME, {
    render: function() {
            return <Fragment>
                <PluginSidebarMoreMenuItem
                target={PLUGIN_NAME}
            >
                { __( TITLE ) }
            </PluginSidebarMoreMenuItem>

                <PluginSidebar
                        name={PLUGIN_NAME}
                        icon="admin-post"
                        title={ __(TITLE) }
                    >
                        
                    <Panel>
                        <PanelBody
                        title="Quiz Topics"
                        icon="welcome-widgets-menus"
                        initialOpen={ true }
                        >
                        <PanelRow>
                            <SnackalbeQuizList />
                        </PanelRow>
                        </PanelBody>
                    </Panel>

                    </PluginSidebar>
            </Fragment>;
    },
} );