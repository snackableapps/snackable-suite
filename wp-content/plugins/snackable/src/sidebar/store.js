const { data, apiFetch } = wp;
const { registerStore } = data;

const DEFAULT_STATE = {
    topics: {
        'topic': {
            id: 'topic',
            topic: 'topic'
        }
    },
    questions: {},
    loaded: false,
};

const actions = {
    setTopic( id, topic ) {
        return {
            type: 'SET_TOPIC',
            id,
            topic
        };
    },
    load( json ) {
        let data = {}; 
        try {
            data = JSON.parse(json);
        } catch (e) {
            data = Object.assign({}, DEFAULT_STATE);
        }
        return {
            type: 'SET_LOADED',
            data
        };

    },
};

registerStore( 'snackable/quiz', {
    reducer( state = DEFAULT_STATE, action ) {
        switch ( action.type ) {
            case 'SET_TOPIC':
                const newTopics = Object.assign({}, state.topics);
                newTopics[action.id] = {
                    id: action.id,
                    topic: action.topic
                };
                
                console.log('ACTION', action, state);

                return {
                    ...state,
                    topics: newTopics
                };
            case 'SET_LOADED':
                return {
                    ...action.data,
                    loaded: true
                }
        }

        return state;
    },

    actions,

    selectors: {
        getTopics( state ) {
            const { topics } = state;
            return Object.values(topics).sort( (id) => id); 
        },

        serialize( state ) {
            const data = Object.assign({}, state);
            delete data.loaded;
            return JSON.stringify(data);
        },

        isLoaded ({ loaded }) {
            return loaded;
        }
    },

    controls: {
        FETCH_FROM_API( action ) {
            return apiFetch( { path: action.path } );
        },
    },

    resolvers: {
     
    },
} );
