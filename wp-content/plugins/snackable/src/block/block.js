/**
 * BLOCK: snackable-quiz
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */



const { __ } = wp.i18n;
const { registerBlockType,  } = wp.blocks;
const { InnerBlocks } = wp.editor;
const { Component } = wp.element;
const { TextControl } = wp.components;
const { withSelect } = wp.data;
//  Import CSS.
import './style.scss';
import './editor.scss';


class SnackableQuizEditBlock extends Component {
	constructor( props ) {
		super(props);

		this.state = {
			choices: {}
		}

		let { attributes } = this.props;
		let choices = attributes.choices || [];
		
		choices.forEach((e) => {
			const {id} = e; 
			this.state.choices[id] = e;
		});
	}

	saveChoice(id, name) {
		let newChoices = Object.assign({}, this.state.choices);
		newChoices[id] = {
			id, name
		};
		
		this.props.setAttributes( { 'choices': Object.values(newChoices) } );

		this.setState({
			choices: newChoices
		});
	}

	render( ) {
		const props = this.props; 
		const { attributes, setAttributes } = props;
		const { choices } = this.state;

		const saveChoice = this.saveChoice.bind(this);

		return <div className="snackable-quiz-question">
			<p><TextControl type="text" 
				value={attributes.question}
				onChange={( val ) => {
					setAttributes( { question:  val } );
				}}
				/> 
			</p>
			<table> 
				{ props.topics.map( ({id, topic}) => <tr>
					<td>
							<code>{ topic }</code>
					</td>
					<td>
						<TextControl
							className="question-input"
							placeholder="Please enter a question here"
							value={ ( choices[id] || {  name: null }).name }
							onChange={( val ) => {
								saveChoice(id, val)
							}}
						type="text" /> 
					</td>
				</tr>)} 
			</table>
		</div>;
	}
}

registerBlockType('snackable/block-snackable-quiz-results', {
	title: __( 'Snackable Quiz - Quiz Results' ),
	icon: 'shield',
	category: 'common',
	keywords: ['quiz', 'snackable'],
	edit: () => <div className="snackable-quiz-results">Results will be displayed here</div>, 
	save: () => null
})

registerBlockType( 'snackable/block-snackable-quiz', {
	title: __( 'Snackable Quiz - Quiz Item' ),
	icon: 'shield',
	category: 'common',
	keywords: [
		__( 'Snackable Quiz - Quiz Item' )
	],

	attributes: {
		question: {
			type: 'string',
		},
		choices: {
			type: 'array',
			query: {
				id: {
					type: 'string'
				},
				name: {
					type: 'string'
				}
			}
		}
	},

	edit: withSelect( (select) => {
		return {
			topics: select('snackable/quiz').getTopics()
		}
	})(SnackableQuizEditBlock),

	save: () => null
} );
