export default function logger(reducer) {
    return (prevState, action, args) => {
        console.group(action)
        console.log('Prev Stay: ', prevState)
        console.log('Action arguments: ', args)
        const nextSate = reducer(prevState, action, args)
        console.log('Next State: ', nextSate)
        console.groupEnd()
        return nextSate
    }
}