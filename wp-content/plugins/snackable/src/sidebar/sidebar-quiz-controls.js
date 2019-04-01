const { Button, TextControl } = wp.components;

const items = [1,2,3,4,5].map( key => ({
    key,
    name: `Key ${key}`
}));

function SnackalbeQuizListItem({key, name}) {
    return <li key={key}>
            <TextControl
                label=""
                value={ name }
                onChange={ ( className ) => setState( { name } ) }
            />
            <Button className="components-button editor-post-preview is-button is-default">Delete</Button>
    </li>;
}

function SnackalbeQuizList ( props ) {
    return <div>
        <ul>
            {items.map( ({key, name}) => <SnackalbeQuizListItem key={key} name={name}/> )}
        </ul>
    </div>;
}

module.exports = {
    SnackalbeQuizList
}