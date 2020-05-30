<a href="/page/1" class="button">First</a>
<a href="<?php if($pagenr <= 1){ echo '/#'; } else { echo "/page/".($pagenr - 1); } ?>" class="button">Prev</a>
<a href="<?php if($pagenr >= $totalPages){ echo '#'; } else { echo "/page/".($pagenr + 1); } ?>" class="button">Next</a>
<a href="/page/<?php echo $totalPages; ?>" class="button">Last</a>