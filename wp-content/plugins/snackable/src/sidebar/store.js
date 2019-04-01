const { data, apiFetch } = wp;
const { registerStore } = data;

const DEFAULT_STATE = {
    topics: {
        'topic': {
            id: 'topic',
            name: 'topic'
        }
    },
    questions: {},
};

const actions = {
    setTopic( id, topic ) {
        return {
            type: 'SET_TOPIC',
            id,
            topic
        };
    },

};

// const encoded = select('core/editor').getEditedPostAttribute( 'meta' )['snackable_quiz_topics'];

/*

        const newValue = JSON.stringify(newTopics);
        console.log(key, newValue);

        dispatch( 'core/editor' ).editPost(
            { meta: { key : newValue } }
        );

*/

registerStore( 'snackable/quiz', {
    reducer( state = DEFAULT_STATE, action ) {
        switch ( action.type ) {
            case 'SET_TOPIC':
                const newTopics = Object.assign({}, state.topics);
                newTopics[action.id] = {
                    id: action.id,
                    topic: action.topic
                };

                return {
                    ...state,
                    topics: newTopics
                };
        }

        return state;
    },

    actions,

    selectors: {
        getTopics( state ) {
            const { topics } = state;
            return Object.values(topics).sort( (id) => id); 
        },
    },

    controls: {
        FETCH_FROM_API( action ) {
            return apiFetch( { path: action.path } );
        },
    },

    resolvers: {
     
    },
} );
