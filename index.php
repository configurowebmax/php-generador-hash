<?php
/**
 * Generador de Hash - MD5, SHA-1, SHA-256, SHA-512, CRC32
 */
header('Content-Type: text/html; charset=utf-8');

$texto = '';
$hashes = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['texto'] ?? '';
    if ($texto !== '') {
        $hashes = [
            'MD5'      => hash('md5', $texto),
            'SHA-1'    => hash('sha1', $texto),
            'SHA-256'  => hash('sha256', $texto),
            'SHA-384'  => hash('sha384', $texto),
            'SHA-512'  => hash('sha512', $texto),
            'CRC32'    => hash('crc32', $texto),
            'SHA3-256' => function_exists('hash') && in_array('sha3-256', hash_algos()) ? hash('sha3-256', $texto) : 'no disponible',
            'RIPEMD-160'=> in_array('ripemd160', hash_algos()) ? hash('ripemd160', $texto) : 'no disponible',
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Generador de Hash Online | ConfiguroWeb</title>
<meta name="description" content="Genera hashes MD5, SHA-1, SHA-256, SHA-512, CRC32 y más a partir de cualquier texto. Gratis en ConfiguroWeb.">
<meta name="keywords" content="generador hash, md5, sha256, sha1, crc32, encriptar, checksum">
<link rel="canonical" href="https://demoscweb.com/github/php-generador-hash/">
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"WebApplication","name":"Generador de Hash","applicationCategory":"UtilitiesApplication","operatingSystem":"Any","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"author":{"@type":"Person","name":"ConfiguroWeb","url":"https://configuroweb.com"}}
</script>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
  <h1>#️⃣ Generador de Hash</h1>
  <p class="subtitle">MD5, SHA-1, SHA-256, SHA-512 y más</p>
</header>
<main>
  <form method="POST">
    <label for="texto">Texto a hashear</label>
    <textarea name="texto" id="texto" rows="4" placeholder="Escribe aquí el texto..." required><?php echo htmlspecialchars($texto); ?></textarea>
    <button type="submit" class="btn-primary">#️⃣ Generar hashes</button>
  </form>

  <?php if ($hashes !== null): ?>
  <div class="resultados">
    <h2>Hashes generados</h2>
    <?php foreach ($hashes as $algo => $hash): ?>
    <div class="tarjeta-sm" style="display:block;margin-bottom:.8rem">
      <span class="etiqueta"><?php echo $algo; ?> (<?php echo strlen($hash); ?> chars)</span>
      <code style="display:block;word-break:break-all;font-size:.85rem;background:#f7f7f7;padding:.6rem;border-radius:6px;margin-top:.3rem"><?php echo htmlspecialchars($hash); ?></code>
    </div>
    <?php endforeach; ?>
    <p class="interpretacion">
      🔒 Los hashes son <strong>unidireccionales</strong>: no se pueden revertir para obtener el texto original.
      Se usan para verificar integridad de archivos, almacenar contraseñas y firmas digitales.
      <strong>MD5 y SHA-1 ya no son seguros</strong> para contraseñas; usa <strong>SHA-256</strong> o superior.
    </p>
  </div>
  <?php endif; ?>

  <section class="info">
    <h2>¿Qué es un hash?</h2>
    <p>Un hash es una huella digital de longitud fija generada a partir de un texto. La misma entrada siempre produce el mismo hash, pero cambiar un solo carácter produce un hash completamente distinto.</p>
  </section>
</main>
<footer>
  <p>Desarrollado por <a href="https://configuroweb.com" target="_blank">ConfiguroWeb</a> ·
     <a href="https://appscweb.com/citas/" target="_blank">Sistema de Citas</a> ·
     <a href="https://appscweb.com/negocios/" target="_blank">Gestión de Negocios</a></p>
  <p>&copy; <?php echo date('Y'); ?> ConfiguroWeb</p>
</footer>
<script src="assets/script.js"></script>
</body>
</html>