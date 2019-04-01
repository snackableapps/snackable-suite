const { Button, TextControl } = wp.components;
const { select, dispatch, withSelect, withDispatch } =  wp.data;
const { compose } = wp.compose;

require('./store');

const QuizStore = {
    STORE_KEY: 'snackable_quiz_topics',
    getTopics: withSelect( (select) => {    
        return {
            topics: select('snackable/quiz').getTopics()
        }  
    }),

    setTopic: (id) => (value) => {
        console.log(id, value);
        dispatch('snackable/quiz').setTopic(id, value)
    },
}

const SnackalbeQuizListItem =  compose(QuizStore.getTopics)(({id, name, topics}) => {
    console.log('id', id);
    return <li key={id}>
            <TextControl
                label=""
                value={ name }
                onChange={ QuizStore.setTopic(id) }
            />
            <Button className="components-button editor-post-preview is-button is-default">Delete</Button>
    </li>;
});

const SnackalbeQuizList =  compose(QuizStore.getTopics)(( { topics } ) => {
    const topicKeys = Object.values(topics).sort( ({id}) => id);

    return <div>
        <ul>
            {topicKeys.map( ({id, name}) => <SnackalbeQuizListItem key={id} id={id} name={name}/> )}
        </ul>
    </div>;
});

module.exports = {
    SnackalbeQuizList
}