import java.util.regex.Pattern

fun cesar(input: String, offset: Int, charset: String): String {
    val str = StringBuilder()
    for(c in input) {
        if(Pattern.compile("\\s").matcher(Character.toString(c)).matches()) {
            str.append(c)
        }
        val j = charset.indexOf(c)
        str.append(
            charset[(j + offset + charset.length) % charset.length]
        )
    }
    return str.toString()
}


