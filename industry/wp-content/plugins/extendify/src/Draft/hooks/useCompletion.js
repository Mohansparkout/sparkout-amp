import { useEffect, useState } from '@wordpress/element'
import { completion } from '@draft/api/Data'

export const useCompletion = (prompt) => {
    const [result, setResult] = useState('')
    const [error, setError] = useState(null)
    const [loading, setLoading] = useState(false)

    useEffect(() => {
        let cancelled = false
        let reader
        const decoder = new TextDecoder()

        if (!prompt) {
            setLoading(false)
            cancelled = true
            return
        }

        const fetchData = async () => {
            setResult('')
            setError(false)
            setLoading(true)

            const response = await completion(prompt)
            reader = response.body.getReader()

            let done = false
            while (!done) {
                const { value, done: readerDone } = await reader.read()

                done = readerDone

                if (value && !cancelled) {
                    const decodedValue = decoder.decode(value)
                    setResult((prevResult) => prevResult + decodedValue)
                }
            }
        }

        fetchData()
            .finally(() => {
                if (!cancelled) {
                    setLoading(false)
                }
            })
            .catch((error) => {
                if (!cancelled) {
                    setError(error)
                }
            })

        return () => {
            cancelled = true
            if (reader) {
                reader.cancel()
            }
        }
    }, [prompt])

    return { completion: result, error, loading }
}