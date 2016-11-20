        <script>
            if (!window.jQuery) {

                document.write(unescape('<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js">%3C/script%3E'));

            }

        </script>
        <style> 
            legend{
                cursor: pointer;
            }
        </style>

        <form name='restore'> 
            <input type='hidden' name='restore_default' value='do' /> 
            <input type='submit' value='Restore default' />
        </form>

        <form class="form" id='configForm' method='post'>
        <?php

        foreach ($this->data as $n => $d_val) {
            if (isset($this->atribute[$n])) {

                $flags['dinamic'] = false;
                $flags = $this->parseAtribute($this->atribute[$n]);

                if (is_array($d_val)) {
                    echo "<fieldset><legend>" . $flags['title'] . "</legend>";
                    echo "<div class='field' " . ($flags['hidden'] ? "style='display:none'" : "") . "> ";

                    foreach ($d_val as $nc => $vc) {

                        if (isset($this->atribute[$n . "~" . $nc])) {
                            $flags = array_merge($flags, $this->parseAtribute($this->atribute[$n . "~" . $nc]));
                        } else {
                            $flags['title'] = $nc;
                        }

                        echo "<div>" . $this->renderInput($flags['title'], $n, $nc, $vc, $flags['options']);

                        if (isset($flags['dinamic']) and $flags['dinamic'] and ! $flags['static']) {
                            echo "<a class='icon-remove' href='javascript:void(0)' onclick='removeOption(this)' >Del</a>";
                        }
                        echo "</div>";

                        if (isset($flags['dinamic']) and $flags['dinamic']) {
                            $flags['static'] = false;
                        }
                    }
                    if (isset($flags['dinamic']) and $flags['dinamic'] and ! $flags['static']) {
                        echo "<a class='icon-plus' href='javascript:void(0)' onclick='addOption(this,\"" . $n . "\")' >Add</a>";
                    }
                    echo "</div></fieldset>";
                } else {
                    echo "<div>";
                    echo $this->renderInput($flags['title'], $n, false, $d_val, $flags['options']);
                    echo "</div>";
                }
            }
        }
        ?>
            <input type='submit' class='btn btn-info' value='Save' />
        </form>

        <script>

            function addOption(t, name) {

                var optList = $(t.parentNode).find('div');
                var opt = parseInt($(optList[optList.length - 1]).find('span').html());

                $("<div><span> " + (opt + 1) + " </span><input type='text' name='config[" + name + "][" + (opt + 1) + "]'  value='' /><a class='icon-remove' href='javascript:void(0)' onclick='removeOption(this)' >Del</a></div>").insertBefore(t);

            }
            function removeOption(t) {
                $(t.parentNode).find('input').attr('value', '~#deleted#~');
                $(t.parentNode).remove();
            }

            $('legend').click(function () {
                $(this).parent().find('div.field').slideToggle();
            });
        </script>
