const { Button, TextControl } = wp.components;
const { select, dispatch, withSelect, withDispatch, subscribe } =  wp.data;
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
        dispatch('snackable/quiz').setTopic(id, value);
        const data = select('snackable/quiz').serialize(); 

        console.log('DATA: ', data);

        wp.data.dispatch( 'core/editor' ).editPost(
            { meta: { snackable_quiz_topics : data } }
        );
    },
}

const SnackalbeQuizListItem =  compose(QuizStore.getTopics)(({id, topic}) => {
    return <li key={id}>
            <TextControl
                label=""
                value={ topic }
                onChange={ QuizStore.setTopic(id) }
            />
            <Button className="components-button editor-post-preview is-button is-default">Delete</Button>
    </li>;
});

const SnackalbeQuizList =  compose(QuizStore.getTopics)(( { topics } ) => {
    const topicKeys = Object.values(topics).sort( ({id}) => id);

    return <div>
        <ul>
            {topicKeys.map( ({id, topic}) => <SnackalbeQuizListItem key={id} id={id} topic={topic}/> )}
        </ul>
    </div>;
});

subscribe( () => {
      var isSavingPost = select('core/editor').isSavingPost();
      var isAutosavingPost = select('core/editor').isAutosavingPost();
      var isQuizLoaded = select('snackable/quiz').isLoaded();

      if(!isQuizLoaded) {
        try {
            const encoded = select('core/editor').getEditedPostAttribute( 'meta' )['snackable_quiz_topics'];
            dispatch('snackable/quiz').load(encoded);
            console.log(encoded);
        } catch (e) {

        }
      }
});

module.exports = {
    SnackalbeQuizList
}