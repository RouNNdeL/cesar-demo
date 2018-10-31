import java.util.regex.Pattern;

public static String cypher(String input, int offset, String charset) {
    StringBuilder str = new StringBuilder();
    for(int i = 0; i < input.length(); i++) {
        if(Pattern.compile("\\s").matcher(Character.toString(input.charAt(i))).matches()) {
            str.append(input.charAt(i));
            continue;
        }

        int j = charset.indexOf(input.charAt(i));
        str.append(charset.charAt(
            (j + offset + charset.length()) % charset.length()
        ));
    }
    return str.toString();
}